import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { PageProps } from '@/types';
import { Project } from '@/types/project';
import { useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { ja } from 'date-fns/locale';

export default function TaskCreate({
    project,
}: PageProps & { project: Project }) {
    const [selectedStartDate, setSelectedStartDate] = useState<Date | null>(null);
    const [selectedEndDate, setSelectedEndDate] = useState<Date | null>(null);

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
                <div className='mb-3'>
                    <InputLabel value='種別' htmlFor='type'></InputLabel>
                    <select
                        id='type'
                        className='rounded text-sm min-w-44 max-w-64 border-gray-300 shadow-sm'
                        name='type'
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
                    ></TextInput>
                </div>
                <div className='mb-5'>
                    <InputLabel value='詳細' htmlFor='body'></InputLabel>
                    <textarea
                        className='rounded-md border-gray-300 shadow-sm w-full text-sm'
                        rows={13}
                        name='body'
                        id='body'
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
                            name='state'
                            id='state'
                            className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
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
                            name='priority'
                            id='priority'
                            className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        >
                            <option value='' disabled selected>
                                選択してください
                            </option>
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
                            name='version'
                            id='version'
                            className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        >
                            <option value='' disabled selected>
                                選択してください
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
                            selected={selectedStartDate}
                            onChange={(date) => setSelectedStartDate(date)}
                            locale={ja}
                            placeholderText='日付を選択してください'
                            dateFormat='yyyy/MM/dd'
                            className='p-2 border border-gray-300 rounded-md shadow-sm'
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
                            selected={selectedEndDate}
                            onChange={(date) => setSelectedEndDate(date)}
                            locale={ja}
                            placeholderText='日付を選択してください'
                            dateFormat='yyyy/MM/dd'
                            className='p-2 border border-gray-300 rounded-md shadow-sm'
                        />
                    </div>
                </div>
                <hr />
            </div>
        </ProjectLayout>
    );
}
