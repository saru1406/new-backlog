import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import { Project } from '@/types/project';
import ProjectsTable from '@/Components/ProjectsTable';
import Modal from '@/Components/Modal';
import { useState, useEffect, FormEventHandler } from 'react';
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import Message from '@/Components/Message';

export default function ProjectIndex({
    auth,
    projects,
    message,
    error_message,
}: PageProps & {
    projects: Project[];
    message?: string;
    error_message?: string;
}) {
    const [isCreate, setIsCreate] = useState<boolean>(false);

    const { data, setData, post, processing, errors } = useForm({
        project_name: '',
    });

    const openModal = () => {
        setIsCreate(true);
    };

    const closeModal = () => {
        setIsCreate(false);
    };

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('projects.store'), {
            onSuccess: () => {
                closeModal();
                setData('project_name', '');
            },
        });
    };

    useEffect(() => {}, [message, error_message]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    Dashboard
                </h2>
            }
        >
            <Head title='Dashboard' />

            <Message message={message} error_message={error_message} />
            <div className='py-12'>
                <div className='max-w-7xl mx-auto sm:px-6 lg:px-8'>
                    <div className='overflow-hidden sm:rounded-lg'>
                        <p>プロジェクト一覧</p>
                        <ProjectsTable projects={projects} />
                    </div>
                    <div className='my-12'>
                        <button
                            className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            onClick={openModal}
                        >
                            プロジェクト作成
                        </button>
                        <Modal
                            show={isCreate}
                            onClose={closeModal}
                            maxWidth='xl'
                        >
                            <form
                                onSubmit={handleSubmit}
                                className='w-full max-w-xl my-24 mx-10'
                            >
                                <div>
                                    <div>
                                        <InputLabel value='プロジェクト名' />
                                        {errors.project_name && (
                                            <p className='text-red-500'>
                                                {errors.project_name}
                                            </p>
                                        )}
                                        <TextInput
                                            className='w-5/6'
                                            value={data.project_name}
                                            onChange={(e) =>
                                                setData(
                                                    'project_name',
                                                    e.target.value
                                                )
                                            }
                                        ></TextInput>
                                    </div>
                                    <div className='my-5'>
                                        <PrimaryButton
                                            className='bg-blue-500'
                                            disabled={processing}
                                        >
                                            {processing ? '作成中...' : '作成'}
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </Modal>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
