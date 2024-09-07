import { Project } from "@/types/project";


export default function ProjectsTable({ projects }: { projects: Project[] }) {
    if (!projects || projects.length === 0) {
        return <p>プロジェクトが作成されていません</p>;
    }

    return (
        <div>
            {projects.map((project) => (
                <div key={project.id} className="bg-white border border-gray-300 max-w-md">
                    <p className="px-3">{project.project_name}</p>
                    <p className="px-3 text-gray-300">{project.created_at}</p>
                </div>
            ))}
        </div>
    );
}

