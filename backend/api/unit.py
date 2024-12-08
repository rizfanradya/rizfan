from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from utils.database import get_db
from utils.auth import TokenAuthorization
from utils.error_response import send_error_response
from typing import Optional
from sqlalchemy import or_
from models.unit import Unit
from schemas.unit import UnitSchema, UnitResponseSchema

router = APIRouter()


@router.post('/unit')
def create_unit(unit: UnitSchema, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    try:
        new_data = Unit(**unit.dict())
        db.add(new_data)
        db.commit()
        db.refresh(new_data)
        return new_data
    except Exception as error:
        send_error_response(str(error), 'unit already exist')


@router.put('/unit/{id}')
def update_unit(id: int, unit: UnitSchema, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    data_info = db.query(Unit).get(id)
    if data_info is None:
        send_error_response('Data not found')
    try:
        for key, value in unit.dict().items():
            if value is not None:
                setattr(data_info, key, value)
        db.commit()
        db.refresh(data_info)
        return data_info
    except Exception as error:
        send_error_response(str(error), 'unit already exist')


@router.get('/unit', response_model=UnitResponseSchema)
def get_unit(limit: int = 10, offset: int = 0, search: Optional[str] = None, id: Optional[int] = None, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    query = db.query(Unit)
    if id:
        query = query.where(Unit.id == id)
    if search:
        query = query.filter(or_(*[getattr(Unit, column).ilike(
            f"%{search}%"
        ) for column in Unit.__table__.columns.keys()]  # type: ignore
        ))
    total_data = query.count()
    query = query.offset(offset).limit(limit).all()  # type: ignore
    return {
        "total_data": total_data,
        "data": query
    }


@router.delete('/unit/{id}')
def delete_unit(id: int, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    try:
        data = db.query(Unit).get(id)
        if data:
            db.delete(data)
            db.commit()
    except Exception as error:
        send_error_response(str(error), 'Cannot delete this data')
