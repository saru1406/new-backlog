import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { PageProps, User } from '@/types';
import { Project } from '@/types/project';
import 'react-datepicker/dist/react-datepicker.css';
import Message from '@/Components/Message';
import { Task } from '@/types/task';
import { format } from 'date-fns';
import { Link } from '@inertiajs/react';
import { useState } from 'react';
import Modal from '@/Components/Modal';
import CreateChildTaskFrom from '@/features/ChildTask/CreateChildTaskFrom';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';
import { ChildTask } from '@/types/child_task';

export default function TaskShow({
    project,
    task,
    child_tasks,
    users,
    states,
    types,
    priorities,
    message,
    error_message,
}: {
    project: Project;
    task: Task;
    child_tasks: ChildTask[];
    users: User[];
    states: State[];
    types: Type[];
    priorities: Priority[];
    message?: string;
    error_message?: string;
}) {
    const [openModal, setOpenModal] = useState<boolean>(false)
    const closeModal = () => {
        setOpenModal(false);
    };
    console.log(child_tasks)
    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <Message message={message} error_message={error_message} />
            <div className='mx-20 my-8'>
                <div className='bg-white border border-gray-300 px-10 pt-10 pb-20 rounded-md mb-12'>
                    <div className='mb-3'>
                        <InputLabel htmlFor='type'>種別</InputLabel>
                        <TextInput
                            className='text-sm'
                            value={task.type ? task.type.type_name : ''}
                            disabled
                        ></TextInput>
                    </div>
                    <div className='mb-10'>
                        <InputLabel htmlFor='title'>件名</InputLabel>
                        <TextInput
                            className='w-full'
                            value={task.title}
                            disabled
                        ></TextInput>
                    </div>
                    <div className='mb-5'>
                        <InputLabel value='詳細' htmlFor='body'></InputLabel>
                        <textarea
                            className='rounded-md border-gray-300 shadow-sm w-full text-sm overflow-auto resize-none'
                            value={task.body}
                            rows={13}
                            disabled
                        ></textarea>
                    </div>
                    <hr />
                    <div className='flex my-5'>
                        <div className='w-full flex mr-7'>
                            <label
                                htmlFor='state'
                                className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                            >
                                状態
                            </label>
                            <p className='flex items-center'>
                                {task.state.state_name}
                            </p>
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='manager'
                                className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                            >
                                担当者
                            </label>
                            <p className='flex items-center'>
                                {task.manager ? task.manager.name : null}
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div className='flex my-5'>
                        <div className='w-full flex mr-7'>
                            <label
                                htmlFor='priority'
                                className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                            >
                                優先度
                            </label>
                            <p className='flex items-center text-center'>
                                {task.priority
                                    ? task.priority.priority_name
                                    : null}
                            </p>
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='version'
                                className='font-medium text-sm text-gray-700 flex items-center w-1/3'
                            >
                                発生バージョン
                            </label>
                            <p className='flex items-center text-center'>
                                {task.version_id}
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div className='flex my-5'>
                        <div className='w-full flex mr-7'>
                            <label
                                htmlFor='start_date'
                                className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                            >
                                開始日
                            </label>
                            <p className='flex items-center text-center'>
                                {task.start_date
                                    ? format(
                                        new Date(task.start_date),
                                        'yyyy/MM/dd'
                                    )
                                    : null}
                            </p>
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='end_date'
                                className='font-medium text-sm text-gray-700 flex items-center w-1/3'
                            >
                                期限日
                            </label>
                            <p className='flex items-center text-center'>
                                {task.end_date
                                    ? format(
                                        new Date(task.end_date),
                                        'yyyy/MM/dd'
                                    )
                                    : null}
                            </p>
                        </div>
                    </div>
                    <hr />
                </div>
                <div className="relative pt-6 rounded-md">
                    <div className="absolute -top-3 bg-white px-10 py-2 rounded-t-md border border-b-0 border-gray-300 text-sm">
                        子タスク
                    </div>
                    <div className="bg-white border border-gray-300 px-10 pt-10 pb-20 rounded-md rounded-tl-none">
                        <div className="flex justify-end mb-5">
                            <button
                                className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                                onClick={() => setOpenModal(true)}
                            >
                                追加
                            </button>
                            <button
                                className='ml-5 bg-blue-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-blue-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            >
                                AIで自動作成
                            </button>
                        </div>
                        <Modal
                            show={openModal}
                            onClose={closeModal}
                            maxWidth='2xl'
                        >
                            <div className='m-5'>
                                <CreateChildTaskFrom
                                    project={project}
                                    task={task}
                                    users={users}
                                    states={states}
                                    types={types}
                                    priorities={priorities}
                                    closeModal={closeModal}
                                />
                            </div>
                        </Modal>
                        <table className='border-collapse border border-gray-300 w-full mx-auto bg-white rounded-lg'>
                            <thead className='text-left shadow-sm text-teal-500'>
                                <tr>
                                    <th className='py-1 px-2'>キー</th>
                                    <th className='py-1 px-2'>件名</th>
                                    <th className='py-1 px-2'>種別</th>
                                    <th className='py-1 px-2'>状態</th>
                                    <th className='py-1 px-2'>優先度</th>
                                    <th className='py-1 px-2'>担当者</th>
                                    <th className='py-1 px-2'>発生バージョン</th>
                                    <th className='py-1 px-2'>開始日</th>
                                    <th className='py-1 px-2'>期限日</th>
                                </tr>
                            </thead>
                            {child_tasks.map((child_task) => (
                            <tbody
                                key={child_task.id}
                                className='border border-gray-300 text-sm'
                            >
                                <tr>
                                    <td className='py-2 px-2'>
                                        <Link
                                            href={route('tasks.show', [
                                                project.id,
                                                child_task.id,
                                            ])}
                                            className='text-blue-600'
                                        >
                                            {child_task.id}
                                        </Link>
                                    </td>
                                    <td className='py-2 px-2'>{child_task.title}</td>
                                    <td className='py-2 px-2'>
                                        {child_task.type?.type_name}
                                    </td>
                                    <td className='py-2 px-2 text-white text-nowrap'>
                                        <span
                                            className={`rounded-full py-1 px-2 ${
                                                child_task.state?.state_name ===
                                                '処理済み'
                                                    ? 'bg-indigo-500'
                                                    : child_task.state?.state_name ===
                                                        '未対応'
                                                      ? 'bg-orange-400'
                                                      : child_task.state
                                                              ?.state_name ===
                                                          '処理中'
                                                        ? 'bg-green-500'
                                                        : child_task.state
                                                                ?.state_name ===
                                                            '完了'
                                                          ? 'bg-slate-500'
                                                          : ''
                                            }`}
                                        >
                                            {child_task.state?.state_name}
                                        </span>
                                    </td>
                                    <td className='py-2 px-2'>
                                        {child_task.priority?.priority_name}
                                    </td>
                                    <td className='py-2 px-2 text-nowrap'>
                                        {child_task.manager?.name}
                                    </td>
                                    <td className='py-2 px-2'>
                                        {child_task.version_id}
                                    </td>
                                    <td className='py-2 px-2 text-nowrap'>
                                        {format(
                                            new Date(child_task.start_date),
                                            'yyyy/MM/dd'
                                        )}
                                    </td>
                                    <td className='py-2 px-2 text-nowrap'>
                                        {format(
                                            new Date(child_task.end_date),
                                            'yyyy/MM/dd'
                                        )}
                                    </td>
                                </tr>
                            </tbody>
                        ))}
                        </table>
                    </div>
                </div>
            </div>
        </ProjectLayout>
    );
}
