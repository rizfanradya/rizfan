from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from utils.database import get_db
from utils.auth import TokenAuthorization
from utils.error_response import send_error_response
from typing import Optional
from datetime import date
from sqlalchemy import or_
from models.financial_records import FinancialRecords
from schemas.financial_records import FinancialRecordsSchema, FinancialRecordsResponseSchema

router = APIRouter()


@router.post('/financial_records')
def create_financial_records(financial_records: FinancialRecordsSchema, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    try:
        new_data = FinancialRecords(**financial_records.dict())
        db.add(new_data)
        db.commit()
        db.refresh(new_data)
        return new_data
    except Exception as error:
        send_error_response(str(error), 'role id or unit id not found')


@router.put('/financial_records/{id}')
def update_financial_records(id: int, financial_records: FinancialRecordsSchema, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    data_info = db.query(FinancialRecords).get(id)
    if data_info is None:
        send_error_response('Data not found')
    try:
        for key, value in financial_records.dict().items():
            if value is not None:
                setattr(data_info, key, value)
        db.commit()
        db.refresh(data_info)
        return data_info
    except Exception as error:
        send_error_response(str(error), 'role id or unit id not found')


@router.get('/financial_records', response_model=FinancialRecordsResponseSchema)
def get_financial_records(
    limit: int = 10,
    offset: int = 0,
    search: Optional[str] = None,
    id: Optional[int] = None,
    date: Optional[date] = None,
    db: Session = Depends(get_db),
    token: str = Depends(TokenAuthorization)
):
    query = db.query(FinancialRecords)

    if id:
        query = query.where(FinancialRecords.id == id)
    if date:
        query = query.where(FinancialRecords.created_at == date)

    if search:
        query = query.filter(or_(*[getattr(FinancialRecords, column).ilike(
            f"%{search}%"
            # type: ignore
        ) for column in FinancialRecords.__table__.columns.keys()]
        ))

    total_data = query.count()
    query = query.offset(offset).limit(limit).all()  # type: ignore

    for data in query:
        data.total = data.amount * data.price

    return {
        "total_data": total_data,
        "total": sum(data.total for data in query),
        "data": query
    }


@router.delete('/financial_records/{id}')
def delete_financial_records(id: int, db: Session = Depends(get_db), token: str = Depends(TokenAuthorization)):
    try:
        data = db.query(FinancialRecords).get(id)
        if data:
            db.delete(data)
            db.commit()
    except Exception as error:
        send_error_response(str(error), 'Cannot delete this data')
