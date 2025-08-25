export interface Category {
    id: number;
    name: string;
    description?: string;
    // other properties
}

export interface Product {
    id: number;
    name: string;
    description?: string;
    stock: number;
    category_id: number;
    category: Category[];
    // other properties
}