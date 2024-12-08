from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from utils.database import get_db
from utils.auth import TokenAuthorization
from utils.error_response import send_error_response
from typing import Optional
from datetime import date, datetime, timedelta
from sqlalchemy import or_
from models.financial_records import FinancialRecords
from schemas.financial_records import FinancialRecordsSchema, FinancialRecordsResponseSchema
from sqlalchemy.sql import func

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
    user_id: Optional[int] = None,
    date: Optional[date] = None,
    db: Session = Depends(get_db),
    token: str = Depends(TokenAuthorization)
):
    query = db.query(FinancialRecords)
    total_day = 0
    total_week = 0
    total_month = 0
    total_year = 0

    if id:
        query = query.where(FinancialRecords.id == id)\

    if date:
        start_of_day = datetime.combine(date, datetime.min.time())
        end_of_day = datetime.combine(date, datetime.max.time())
        start_of_week = datetime.combine(
            date - timedelta(days=date.weekday()), datetime.min.time()
        )
        end_of_week = datetime.combine(
            start_of_week + timedelta(days=6), datetime.max.time()
        )
        start_of_month = date.replace(day=1)
        end_of_month = (start_of_month + timedelta(days=31)
                        ).replace(day=1) - timedelta(days=1)
        start_of_year = date.replace(month=1, day=1)
        end_of_year = date.replace(month=12, day=31)
        total_day = db.query(func.sum(FinancialRecords.amount * FinancialRecords.price)).filter(
            FinancialRecords.created_at.between(start_of_day, end_of_day)
        ).scalar() or 0
        total_week = db.query(func.sum(FinancialRecords.amount * FinancialRecords.price)).filter(
            FinancialRecords.created_at.between(start_of_week, end_of_week)
        ).scalar() or 0
        total_month = db.query(func.sum(FinancialRecords.amount * FinancialRecords.price)).filter(
            FinancialRecords.created_at.between(start_of_month, end_of_month)
        ).scalar() or 0
        total_year = db.query(func.sum(FinancialRecords.amount * FinancialRecords.price)).filter(
            FinancialRecords.created_at.between(start_of_year, end_of_year)
        ).scalar() or 0
        query = query.where(
            FinancialRecords.created_at.between(start_of_day, end_of_day))

    if user_id:
        query = query.where(FinancialRecords.user_id == user_id)

    if search:
        query = query.filter(or_(*[getattr(FinancialRecords, column).ilike(
            f"%{search}%"
        ) for column in FinancialRecords.__table__.columns.keys()]))

    total_data = query.count()
    query = query.offset(offset).limit(limit).all()  # type: ignore

    for data in query:
        data.total = data.amount * data.price

    return {
        "total_data": total_data,
        "total_day": total_day,
        "total_week": total_week,
        "total_month": total_month,
        "total_year": total_year,
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
