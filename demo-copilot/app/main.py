from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from .database import engine
from .models import models
from .routes import categories

# Create database tables
models.Base.metadata.create_all(bind=engine)

app = FastAPI(
    title="Shoe Store API",
    description="API for shoe store categories and products",
    version="1.0.0"
)

# Configure CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Include routers
app.include_router(categories.router)

@app.get("/")
async def root():
    return {"message": "Welcome to Shoe Store API"}