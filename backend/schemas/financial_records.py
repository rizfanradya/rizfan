from pydantic import BaseModel
from typing import List
from datetime import datetime


class FinancialRecordsSchema(BaseModel):
    created_at: datetime
    name: str
    amount: int
    unit_id: int
    user_id: int
    price: float


class BaseSchema(FinancialRecordsSchema):
    id: int

    class Config:
        from_attributes = True


class BaseFinancialRecordsResponseSchema(FinancialRecordsSchema):
    total: float


class FinancialRecordsResponseSchema(BaseModel):
    total_data: int
    total: float
    data: List[BaseFinancialRecordsResponseSchema]

    class Config:
        from_attributes = True
