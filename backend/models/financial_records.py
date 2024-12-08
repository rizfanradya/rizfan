from utils.database import Base
from sqlalchemy.schema import Column
from sqlalchemy.types import String, Integer, Numeric, DateTime
from sqlalchemy.orm import relationship
from sqlalchemy import ForeignKey
import pytz
from datetime import datetime
from .unit import Unit

WIB = pytz.timezone('Asia/Jakarta')


class FinancialRecords(Base):
    __tablename__ = "financial_records"

    id = Column(Integer, primary_key=True, index=True)
    created_at = Column(
        DateTime,
        nullable=False,
        default=lambda: datetime.now(WIB).replace(tzinfo=None)
    )
    name = Column(String(length=255), nullable=False)
    amount = Column(Integer, nullable=False)
    price = Column(Numeric(precision=10, scale=2), nullable=False)
    unit_id = Column(Integer, ForeignKey('unit.id'), nullable=False)
    unit = relationship('Unit', back_populates='financial_records')
    user_id = Column(Integer, ForeignKey('user.id'), nullable=False)
    user = relationship('User', back_populates='financial_records')
