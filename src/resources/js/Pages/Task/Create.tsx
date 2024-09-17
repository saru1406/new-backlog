import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { PageProps } from '@/types';
import { Project } from '@/types/project';
import { useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { ja } from 'date-fns/locale';
import { useForm } from '@inertiajs/react';

export default function TaskCreate({
    project,
}: PageProps & { project: Project }) {
    const [selectedStartDate, setSelectedStartDate] = useState<Date | null>(
        null
    );
    const [selectedEndDate, setSelectedEndDate] = useState<Date | null>(null);

    const handleDate = (
        name: 'start_date' | 'end_date',
        date: null | Date
    ): void => {
        if (name === 'start_date') {
            setSelectedStartDate(date);
            if (date) {
                setData(name, date.toISOString());
            } else {
                setData(name, '');
            }
        }
        if (name === 'end_date') {
            setSelectedEndDate(date);
            if (date) {
                setData(name, date.toISOString());
            } else {
                setData(name, '');
            }
        }
    };

    const { data, setData, post, processing, errors, reset } = useForm<{
        type_id: number;
        title: string;
        body: string;
        state_id: number;
        manager: string;
        priority_id: number;
        version_id: number | null;
        start_date: string | null;
        end_date: string | null;
    }>({
        type_id: 1,
        title: '',
        body: '',
        state_id: 1,
        manager: '1',
        priority_id: 1,
        version_id: null,
        start_date: '',
        end_date: '',
    });

    const handleSelectType = (
        e: React.ChangeEvent<HTMLSelectElement>,
        name: 'type_id' | 'state_id' | 'priority_id' | 'version_id'
    ) => {
        const selectChangeNumber = Number(e.target.value);

        if (selectChangeNumber === 0) {
            setData(name, null);
            return;
        }
        setData(name, selectChangeNumber);
    };

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>): void => {
        e.preventDefault();
        post(route('tasks.store', project.id), {
            onSuccess: () => {
                reset();
            },
        });
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
            <div className='mx-40 my-8'>
                <form onSubmit={handleSubmit}>
                    <div className='mb-3'>
                        <InputLabel value='種別' htmlFor='type'></InputLabel>
                        <select
                            id='type'
                            className='rounded text-sm min-w-44 max-w-64 border-gray-300 shadow-sm'
                            name='type_id'
                            onChange={(e) => handleSelectType(e, 'type_id')}
                        >
                            <option value='1'>タスク</option>
                            <option value='2'>課題</option>
                            <option value='3'>TODO</option>
                        </select>
                    </div>
                    <div className='mb-10'>
                        <InputLabel value='件名' htmlFor='title'></InputLabel>
                        <TextInput
                            id='title'
                            className='text-sm w-full'
                            name='title'
                            onChange={(e) => setData('title', e.target.value)}
                            required
                        ></TextInput>
                    </div>
                    <div className='mb-5'>
                        <InputLabel value='詳細' htmlFor='body'></InputLabel>
                        <textarea
                            className='rounded-md border-gray-300 shadow-sm w-full text-sm'
                            rows={13}
                            name='body'
                            id='body'
                            onChange={(e) => setData('body', e.target.value)}
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
                            <select
                                name='state_id'
                                id='state'
                                className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                onChange={(e) =>
                                    handleSelectType(e, 'state_id')
                                }
                            >
                                <option value='1'>未対応</option>
                                <option value='2'>対応中</option>
                                <option value='3'>対応済み</option>
                                <option value='4'>完了</option>
                            </select>
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='manager'
                                className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                            >
                                担当者
                            </label>
                            <select
                                name='manager'
                                id='manager'
                                className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                onChange={(e) =>
                                    setData('manager', e.target.value)
                                }
                            >
                                <option value='1'>未対応</option>
                                <option value='2'>対応中</option>
                                <option value='3'>対応済み</option>
                                <option value='4'>完了</option>
                            </select>
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
                            <select
                                name='priority_id'
                                id='priority'
                                className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                onChange={(e) =>
                                    handleSelectType(e, 'priority_id')
                                }
                            >
                                <option value='1'>低</option>
                                <option value='2'>中</option>
                                <option value='3'>高</option>
                            </select>
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='version'
                                className='font-medium text-sm text-gray-700 flex items-center w-1/3'
                            >
                                発生バージョン
                            </label>
                            <select
                                name='version_id'
                                id='version'
                                className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                onChange={(e) =>
                                    handleSelectType(e, 'version_id')
                                }
                            >
                                <option value='' selected>
                                    未設定
                                </option>
                                <option value='1'>要件定義</option>
                                <option value='2'>設計</option>
                                <option value='3'>開発</option>
                                <option value='4'>テスト</option>
                            </select>
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
                            <DatePicker
                                id='start_date'
                                selected={selectedStartDate}
                                onChange={(date) =>
                                    handleDate('start_date', date)
                                }
                                locale={ja}
                                placeholderText='日付を選択してください'
                                dateFormat='yyyy/MM/dd'
                                className='p-2 border border-gray-300 rounded-md shadow-sm'
                                isClearable
                            />
                        </div>
                        <div className='w-full flex'>
                            <label
                                htmlFor='end_date'
                                className='font-medium text-sm text-gray-700 flex items-center w-1/3'
                            >
                                期限日
                            </label>
                            <DatePicker
                                id='end_date'
                                selected={selectedEndDate}
                                onChange={(date) =>
                                    handleDate('end_date', date)
                                }
                                locale={ja}
                                placeholderText='日付を選択してください'
                                dateFormat='yyyy/MM/dd'
                                className='p-2 border border-gray-300 rounded-md shadow-sm'
                                isClearable
                            />
                        </div>
                    </div>
                    <div className='flex my-16'>
                        <div className='w-full flex mr-7'></div>
                        <div className='w-full flex'>
                            <div className='w-1/3'></div>
                            <button
                                disabled={processing}
                                className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                            >
                                プロジェクト作成
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </ProjectLayout>
    );
}
