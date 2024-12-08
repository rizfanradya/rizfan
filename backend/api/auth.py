from fastapi.security import OAuth2PasswordRequestForm
from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from utils.database import get_db
from utils.auth import create_access_token, create_refresh_token
from utils.config import JWT_REFRESH_SECRET_KEY, ALGORITHM
from models.user import User
from utils.error_response import send_error_response
import jwt
import bcrypt
from schemas.auth import RefreshTokenSchema

router = APIRouter()


@router.post("/token")
async def user_login(form_data: OAuth2PasswordRequestForm = Depends(), db: Session = Depends(get_db)):
    user_info = db.query(User).where(
        User.email == form_data.username).first()
    if user_info is None:
        send_error_response("User not found")
    form_data_pwd = form_data.password.encode('utf-8')
    user_info_pwd = user_info.password.encode('utf-8')  # type: ignore
    bcrypt_checkpw = bcrypt.checkpw(form_data_pwd, user_info_pwd)
    access_token = create_access_token(user_info.id)  # type: ignore
    refresh_token = create_refresh_token(user_info.id)  # type: ignore
    if bcrypt_checkpw:
        return {
            "id": user_info.id,  # type: ignore
            "access_token": access_token,
            "refresh_token": refresh_token,
            "status": True,
            "role": user_info.role.role,  # type: ignore
            "detail": "Login success"
        }
    else:
        raise HTTPException(
            status_code=404,
            detail={
                "id": user_info.id,  # type: ignore
                "access_token": None,
                "refresh_token": None,
                "status": False,
                "role": None,
                "detail": "Password not match"
            }
        )


@router.post("/refresh_token")
async def refresh_token(refresh_token: RefreshTokenSchema, db: Session = Depends(get_db)):
    if JWT_REFRESH_SECRET_KEY is None:
        send_error_response("Environment variable JWT SECRET KEY not set")
    try:
        decode_token = jwt.decode(
            refresh_token.refresh_token,
            JWT_REFRESH_SECRET_KEY,  # type: ignore
            algorithms=[ALGORITHM]
        )
        user_info = db.query(User).get(decode_token.get('id'))
        if user_info is None:
            send_error_response("User not found")
        return {
            "access_token": create_access_token(user_info.id),  # type: ignore
            "refresh_token": create_refresh_token(user_info.id)  # type: ignore
        }
    except jwt.ExpiredSignatureError:
        send_error_response("Token has expired")
    except jwt.InvalidTokenError:
        send_error_response("Token is invalid")
