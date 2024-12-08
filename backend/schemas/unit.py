from pydantic import BaseModel
from typing import List


class UnitSchema(BaseModel):
    unit: str


class BaseSchema(UnitSchema):
    id: int

    class Config:
        from_attributes = True


class UnitResponseSchema(BaseModel):
    total_data: int
    data: List[BaseSchema]

    class Config:
        from_attributes = True
