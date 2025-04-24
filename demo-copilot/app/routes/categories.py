from fastapi import APIRouter, Depends, Query
from sqlalchemy.orm import Session
from typing import Optional
from ..database import get_db
from ..models import models
from ..schemas import schemas

router = APIRouter(
    prefix="/api/v1/categories",
    tags=["categories"]
)

@router.get("", response_model=schemas.CategoryList)
async def list_categories(
    page: Optional[int] = Query(1, ge=1),
    limit: Optional[int] = Query(20, ge=1),
    db: Session = Depends(get_db)
):
    skip = (page - 1) * limit
    total = db.query(models.Type).count()
    categories = db.query(models.Type).offset(skip).limit(limit).all()
    
    return {
        "total": total,
        "items": categories,
        "page": page,
        "limit": limit
    }

@router.get("/{category_id}", response_model=schemas.Category)
async def get_category(category_id: int, db: Session = Depends(get_db)):
    category = db.query(models.Type).filter(models.Type.id == category_id).first()
    return category