// resources/js/types/ActivityLog.d.ts
declare namespace App.Data {
  export interface Causer {
    id: number;
    name: string;
    // Add other user properties you need
  }

  export interface Activity {
    id: number;
    log_name: string;
    description: string;
    subject_type: string;
    subject_id: number;
    causer_id: number | null;
    properties: Record<string, any>;
    created_at: string;
    causer: Causer | null;
  }

  export interface ActivitiesPage extends Paginator {
    data: Activity[];
  }
}