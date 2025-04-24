from pydantic import BaseModel
from typing import List

class Category(BaseModel):
    id: int
    name: str

    class Config:
        orm_mode = True

class CategoryList(BaseModel):
    total: int
    items: List[Category]
    page: int
    limit: int