type Project = {
    id: string;
    project_name: string;
    created_at: string;
};

export type PageProps = {
    projects: Project;
};
