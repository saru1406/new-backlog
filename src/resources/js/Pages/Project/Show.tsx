import { PageProps } from '@/types';
import { Project } from '@/types/project';
import ProjectLayout from '@/Layouts/ProjectLayout';

export default function ProjectIndex({
    auth,
    project,
    message,
    error_message,
}: PageProps & {
    project: Project;
    message?: string;
    error_message?: string;
}) {
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        ></ProjectLayout>
    );
}
