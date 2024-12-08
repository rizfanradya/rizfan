from utils.database import Base
from sqlalchemy.schema import Column
from sqlalchemy.types import String, Integer
from sqlalchemy.orm import relationship


class Unit(Base):
    __tablename__ = "unit"

    id = Column(Integer, primary_key=True, index=True)
    unit = Column(String(length=255), unique=True, nullable=False)
    financial_records = relationship('FinancialRecords', back_populates='unit')
