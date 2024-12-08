from pydantic import BaseModel
from typing import List
from datetime import datetime
from .unit import UnitSchema


class FinancialRecordsSchema(BaseModel):
    created_at: datetime
    name: str
    amount: int
    unit_id: int
    user_id: int
    price: float


class BaseSchema(FinancialRecordsSchema):
    id: int
    unit: UnitSchema

    class Config:
        from_attributes = True


class BaseFinancialRecordsResponseSchema(BaseSchema):
    total: float


class FinancialRecordsResponseSchema(BaseModel):
    total_data: int
    total_day: float
    total_week: float
    total_month: float
    total_year: float
    data: List[BaseFinancialRecordsResponseSchema]

    class Config:
        from_attributes = True
