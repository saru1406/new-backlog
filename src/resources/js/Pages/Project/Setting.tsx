import { PageProps, User } from '@/types';
import { Project } from '@/types/project';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';
import { Link } from '@inertiajs/react';

export default function ProjectSetting({
    project,
    states,
    types,
    priorities,
    users,
    message,
    error_message,
}: PageProps & {
    project: Project;
    state: State[];
    types: Type[];
    priorities: Priority[];
    users: User[];
    message?: string;
    error_message?: string;
}) {
    console.log(users);
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <div className='m-14'>
                <div>
                    <h2 className='mb-3'>種別一覧</h2>
                    <table className='w-1/2'>
                        <thead className='border-b border-gray-500 text-left text-teal-500'>
                            <tr>
                                <th className='py-3 px-5 text-center'>
                                    種別名
                                </th>
                                <th className='py-3 px-5 text-center'>削除</th>
                            </tr>
                        </thead>
                        {types.map((type) => (
                            <tbody
                                key={type.id}
                                className='border-b border-gray-400'
                            >
                                <tr>
                                    <td className='py-3 px-5 text-center'>
                                        {type.type_name}
                                    </td>
                                    <td className='py-3 px-5 text-center text-red-500'>
                                        <span className='cursor-pointer'>
                                            ✕
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        ))}
                    </table>
                </div>
            </div>
            <hr />
            <div className='m-14'>
                <div>
                    <h2 className='mb-3'>優先度一覧</h2>
                    <table className='w-1/2'>
                        <thead className='border-b border-gray-500 text-left text-teal-500'>
                            <tr>
                                <th className='py-3 px-5 text-center'>
                                    優先度名
                                </th>
                                <th className='py-3 px-5 text-center'>削除</th>
                            </tr>
                        </thead>
                        {priorities.map((priority) => (
                            <tbody
                                key={priority.id}
                                className='border-b border-gray-400'
                            >
                                <tr>
                                    <td className='py-3 px-5 text-center'>
                                        {priority.priority_name}
                                    </td>
                                    <td className='py-3 px-5 text-center text-red-500'>
                                        <span className='cursor-pointer'>
                                            ✕
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        ))}
                    </table>
                </div>
            </div>
            <hr />
            <div className='m-14'>
                <div>
                    <h2 className='mb-3'>ユーザー一覧</h2>
                    <table className='w-1/2'>
                        <thead className='border-b border-gray-500 text-left text-teal-500'>
                            <tr>
                                <th className='py-3 px-5 text-center'>
                                    ユーザー名
                                </th>
                                <th className='py-3 px-5 text-center'>削除</th>
                            </tr>
                        </thead>
                        {users.map((user) => (
                            <tbody
                                key={user.id}
                                className='border-b border-gray-400'
                            >
                                <tr>
                                    <td className='py-3 px-5 text-center'>
                                        {user.name}
                                    </td>
                                    <td className='py-3 px-5 text-center text-red-500'>
                                        <span className='cursor-pointer'>
                                            ✕
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        ))}
                    </table>
                </div>
            </div>
            <hr />
        </ProjectLayout>
    );
}
