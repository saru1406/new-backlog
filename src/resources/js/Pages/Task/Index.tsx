import ProjectLayout from '@/Layouts/ProjectLayout';
import { Project } from '@/types/project';
import { Task } from '@/types/task';
import { Link } from '@inertiajs/react';
import { Pagination } from '@/types/pagination';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';

export default function TaskIndex({
    project,
    tasks,
    states,
    types,
    priorities,
}: {
    project: Project;
    tasks: Pagination<Task>;
    states: State[];
    types: Type[];
    priorities: Priority[];
}) {
    console.log(states);
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <div className='m-10 text-sm'>
                <div className='flex'>
                    <label htmlFor='state' className='flex mx-5 items-center'>
                        状態
                    </label>
                    <select
                        className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        name='state_id'
                        id='state'
                    >
                        <option value=''>未選択</option>
                        {states.map((state) => (
                            <option key={state.id} value={state.id}>
                                {state.state_name}
                            </option>
                        ))}
                    </select>
                    <label htmlFor='type' className='flex mx-5 items-center'>
                        種別
                    </label>
                    <select
                        className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        name='type_id'
                        id='type'
                    >
                        <option value=''>未選択</option>
                        {types.map((type) => (
                            <option key={type.id} value={type.id}>
                                {type.type_name}
                            </option>
                        ))}
                    </select>
                    <label
                        htmlFor='priority'
                        className='flex mx-5 items-center'
                    >
                        優先度
                    </label>
                    <select
                        className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        name='priority_id'
                        id='priority'
                    >
                        <option value=''>未選択</option>
                        {priorities.map((priority) => (
                            <option key={priority.id} value={priority.id}>
                                {priority.priority_name}
                            </option>
                        ))}
                    </select>
                </div>
                <div className='my-10'>
                    <table className='border-collapse border border-gray-300 w-full mx-auto bg-white rounded-lg'>
                        <thead className='text-left shadow-sm text-teal-500'>
                            <tr>
                                <th className='py-3 px-2'>番号</th>
                                <th className='py-3 px-2'>件名</th>
                                <th className='py-3 px-2'>種別</th>
                                <th className='py-3 px-2'>状態</th>
                                <th className='py-3 px-2'>優先度</th>
                                <th className='py-3 px-2'>担当者</th>
                                <th className='py-3 px-2'>発生バージョン</th>
                                <th className='py-3 px-2'>開始日</th>
                                <th className='py-3 px-2'>期限日</th>
                            </tr>
                        </thead>
                        {tasks.data.map((task) => (
                            <tbody
                                key={task.id}
                                className='border border-gray-300'
                            >
                                <tr>
                                    <td className='py-3 px-2'>
                                        <Link
                                            href='#'
                                            className='text-blue-600'
                                        >
                                            {task.id}
                                        </Link>
                                    </td>
                                    <td className='py-3 px-2'>{task.title}</td>
                                    <td className='py-3 px-2'>
                                        {task.type.type_name}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.state.state_name}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.priority.priority_name}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.manager.name}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.version_id}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.start_date}
                                    </td>
                                    <td className='py-3 px-2'>
                                        {task.end_date}
                                    </td>
                                </tr>
                            </tbody>
                        ))}
                    </table>
                </div>
            </div>
        </ProjectLayout>
    );
}
