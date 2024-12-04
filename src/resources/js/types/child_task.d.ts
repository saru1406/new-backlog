export type ChildTask = {
    id: number;
    task_id: number;
    title: string;
    body: string;
    priority: {
        priority_name: string;
    };
    state: {
        state_name: string;
    };
    type: {
        type_name: string;
    };
    manager: {
        id: number;
        name: string;
    };
    version_id: string;
    start_date: string;
    end_date: string;
};
