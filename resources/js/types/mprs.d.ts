export interface Project {
    id: number;
    name: string;
    descriptor: string;
    servings: number;
    // other properties
}

export interface Mpr {
    id: number;
    project_id: number;
    version_nbr: number;
    can_edit: boolean;
    project: Project[];
    // other properties
}