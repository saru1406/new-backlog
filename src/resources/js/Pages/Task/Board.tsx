import ProjectLayout from "@/Layouts/ProjectLayout";
import { Project } from "@/types/project";
import { Task } from "@/types/task";

export default function TaskBoard({ project, tasks }: { project: Project; tasks:Task[] }) {
    console.log(tasks)
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <div className="my-10 mx-5">
                <div className="flex">
                    <label htmlFor="state" className="flex mx-5 items-center">状態</label>
                    <select className="flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm" name="state_id" id="state">
                        <option value="">選択</option>
                    </select>
                    <label htmlFor="manager" className="flex mx-5 items-center">担当者</label>
                    <select className="flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm" name="manager_id" id="manager">
                        <option value="">選択</option>
                    </select>
                    <label htmlFor="priority" className="flex mx-5 items-center">優先度</label>
                    <select className="flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm" name="priority_id" id="priority">
                        <option value="">選択</option>
                    </select>
                </div>
                <div className="my-10">
                    <div className="flex overflow-x-auto">
                        <div className="bg-white h-lvh w-full mr-5">
                            未対応
                        </div>
                        <div className="bg-white h-lvh w-full mr-5">
                            対応中
                        </div>
                        <div className="bg-white h-lvh w-full mr-5">
                            対応済み
                        </div>
                        <div className="bg-white h-lvh w-full mr-5">
                            完了
                        </div>
                    </div>
                </div>
            </div>


        </ ProjectLayout>
    )
}
