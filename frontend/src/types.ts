// src/types.ts

export interface Product {
    id: number;
    name: string;
    description?: string; // Puede ser opcional
    price: number;
    date_add?: string; // Puede ser opcional
    created_at: string
}
