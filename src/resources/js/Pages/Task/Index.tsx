import ProjectLayout from "@/Layouts/ProjectLayout";
import { Project } from "@/types/project";

export default function TaskIndex({ project }: { project: Project }) {
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <div className="m-10">
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
                    <table className="border-collapse border border-gray-500 w-full mx-auto">
                        <thead>
                            <tr>
                                <th className="border border-gray-500 bg-white">ヘッダー 1</th>
                                <th className="border border-gray-500 bg-white">ヘッダー 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td className="border border-gray-500">本体 1</td>
                                <td className="border border-gray-500">本体 2</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td className="border border-gray-500">フッター 1</td>
                                <td className="border border-gray-500">フッター 2</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>


        </ ProjectLayout>
    )
}
