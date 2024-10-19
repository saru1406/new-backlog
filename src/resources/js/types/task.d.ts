export type Task = {
    id: number;
    title: string;
    type_id: number;
    state_id: number;
    priority_id: number;
    manager: {
        id: number;
        name: string;
    };
    version_id: string;
    start_date: string;
    end_date: string;
};
