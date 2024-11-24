import { PageProps, User } from '@/types';
import { Project } from '@/types/project';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';
import { Link, useForm, router } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';
import Modal from '@/Components/Modal';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import PrimaryButton from '@/Components/PrimaryButton';

export default function ProjectSetting({
    project,
    states,
    types,
    priorities,
    users,
    company_users,
    message,
    error_message,
}: PageProps & {
    project: Project;
    state: State[];
    types: Type[];
    priorities: Priority[];
    users: User[];
    company_users: User[];
    message?: string;
    error_message?: string;
}) {
    const [isModalOpen, setIsModalOpen] = useState({
        type: false,
        priority: false,
        user: false,
    });

    const openModal = (selectModal: 'type' | 'priority' | 'user') => {
        setIsModalOpen((prev) => ({
            ...prev,
            [selectModal]: true,
        }));
    };

    const closeModal = (selectModal: 'type' | 'priority' | 'user') => {
        setIsModalOpen((prev) => ({
            ...prev,
            [selectModal]: false,
        }));
    };

    const typeForm = useForm({
        type_name: '',
    });
    const priorityForm = useForm({
        priority_name: '',
    });
    // const userForm = useForm({
    //     user_email: '',
    // });

    const handleSubmitType: FormEventHandler = (e) => {
        e.preventDefault();
        typeForm.post(route('types.store', project.id), {
            onSuccess: () => {
                closeModal('type');
                typeForm.reset();
            },
        });
    };

    const handleSubmitPriority: FormEventHandler = (e) => {
        e.preventDefault();
        priorityForm.post(route('priorities.store', project.id), {
            onSuccess: () => {
                closeModal('priority');
                priorityForm.reset();
            },
        });
    };

    const handleSubmitUser = (e: React.MouseEvent<HTMLSpanElement, MouseEvent>, userEmail: string) => {
        e.preventDefault();
        router.post(route('project_users.store', project.id), {
            'user_email': userEmail
        });
        closeModal('user')
    };

    const handleDeleteType = (
        e: React.MouseEvent<HTMLSpanElement, MouseEvent>,
        type: Type
    ) => {
        e.preventDefault();
        router.delete(route('types.destroy', [project.id, type.id]));
    };

    const handleDeletePriority = (
        e: React.MouseEvent<HTMLSpanElement, MouseEvent>,
        priority: Priority
    ) => {
        e.preventDefault();
        router.delete(route('priorities.destroy', [project.id, priority.id]));
    };

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
                    <div className='flex justify-between w-1/2'>
                        <h2 className='mb-3'>種別一覧</h2>
                        <button
                            className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            onClick={() => openModal('type')}
                        >
                            追加
                        </button>
                        <Modal
                            show={isModalOpen.type}
                            onClose={() => closeModal('type')}
                            maxWidth='xl'
                        >
                            <form
                                onSubmit={handleSubmitType}
                                className='w-full max-w-xl my-24 mx-10'
                            >
                                <div>
                                    <div>
                                        <InputLabel value='種別名' />
                                        {typeForm.errors.type_name && (
                                            <p className='text-red-500'>
                                                {typeForm.errors.type_name}
                                            </p>
                                        )}
                                        <TextInput
                                            className='w-5/6'
                                            value={typeForm.data.type_name}
                                            onChange={(e) =>
                                                typeForm.setData(
                                                    'type_name',
                                                    e.target.value
                                                )
                                            }
                                        ></TextInput>
                                    </div>
                                    <div className='my-5'>
                                        <PrimaryButton
                                            className='bg-blue-500'
                                            disabled={typeForm.processing}
                                        >
                                            {typeForm.processing
                                                ? '作成中...'
                                                : '作成'}
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </Modal>
                    </div>
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
                                        <span
                                            onClick={(e) =>
                                                handleDeleteType(e, type)
                                            }
                                            className='cursor-pointer'
                                        >
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
                    <div className='flex justify-between w-1/2'>
                        <h2 className='mb-3'>優先度一覧</h2>
                        <button
                            className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            onClick={() => openModal('priority')}
                        >
                            追加
                        </button>
                        <Modal
                            show={isModalOpen.priority}
                            onClose={() => closeModal('priority')}
                            maxWidth='xl'
                        >
                            <form
                                onSubmit={handleSubmitPriority}
                                className='w-full max-w-xl my-24 mx-10'
                            >
                                <div>
                                    <div>
                                        <InputLabel value='優先度名' />
                                        {priorityForm.errors.priority_name && (
                                            <p className='text-red-500'>
                                                {
                                                    priorityForm.errors
                                                        .priority_name
                                                }
                                            </p>
                                        )}
                                        <TextInput
                                            className='w-5/6'
                                            value={
                                                priorityForm.data.priority_name
                                            }
                                            onChange={(e) =>
                                                priorityForm.setData(
                                                    'priority_name',
                                                    e.target.value
                                                )
                                            }
                                        ></TextInput>
                                    </div>
                                    <div className='my-5'>
                                        <PrimaryButton
                                            className='bg-blue-500'
                                            disabled={priorityForm.processing}
                                        >
                                            {priorityForm.processing
                                                ? '作成中...'
                                                : '作成'}
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </Modal>
                    </div>
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
                                        <span
                                            onClick={(e) =>
                                                handleDeletePriority(
                                                    e,
                                                    priority
                                                )
                                            }
                                            className='cursor-pointer'
                                        >
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
                    <div className='flex justify-between w-1/2'>
                        <h2 className='mb-3'>ユーザー一覧</h2>
                        <button
                            className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            onClick={() => openModal('user')}
                        >
                            追加
                        </button>
                        <Modal
                            show={isModalOpen.user}
                            onClose={() => closeModal('user')}
                            maxWidth='2xl'
                        >
                            <div>{/* TODO 検索機能追加予定 */}</div>
                            <div className='w-full max-w-2xl my-24 mx-auto'>
                                <div>
                                    <div>
                                        <InputLabel value='ユーザー追加' />
                                        <div className='h-80 overflow-y-auto'>
                                            <table className='w-full'>
                                                <thead className='border-b border-gray-500 text-left text-teal-500'>
                                                    <tr>
                                                        <th className='py-3 px-5 text-center'>
                                                            ユーザー名
                                                        </th>
                                                        <th className='py-3 px-5 text-center'>
                                                            メールアドレス
                                                        </th>
                                                        <th className='py-3 px-5 text-center'>
                                                            追加
                                                        </th>
                                                    </tr>
                                                </thead>
                                                {company_users.map(
                                                    (company_user) => (
                                                        <tbody
                                                            key={
                                                                company_user.id
                                                            }
                                                            className='border-b border-gray-400'
                                                        >
                                                            <tr>
                                                                <td className='py-3 pl-14 pr-5'>
                                                                    {
                                                                        company_user.name
                                                                    }
                                                                </td>
                                                                <td className='py-3 pl-24 pr-5'>
                                                                    {
                                                                        company_user.email
                                                                    }
                                                                </td>
                                                                <td className='py-3 px-5 text-center'>
                                                                    <button
                                                                        onClick={(e) =>
                                                                            handleSubmitUser(e, company_user.email)
                                                                        }
                                                                        className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-xs font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                                                                    >
                                                                        追加
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    )
                                                )}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Modal>
                    </div>
                    <table className='w-1/2'>
                        <thead className='border-b border-gray-500 text-left text-teal-500'>
                            <tr>
                                <th className='py-3 px-5 text-center'>
                                    ユーザー名
                                </th>
                                <th className='py-3 px-5 text-center'>
                                    メールアドレス
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
                                    <td className='py-3 pl-14 pr-5'>
                                        {user.name}
                                    </td>
                                    <td className='py-3 pl-24 pr-5'>
                                        {user.email}
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
        </ProjectLayout>
    );
}
