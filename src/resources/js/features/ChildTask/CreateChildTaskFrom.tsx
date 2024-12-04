import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import { User } from '@/types';
import { Priority } from '@/types/priority';
import { Project } from '@/types/project';
import { State } from '@/types/state';
import { Task } from '@/types/task';
import { Type } from '@/types/type';
import { useForm } from '@inertiajs/react';
import { ja } from 'date-fns/locale';
import { useState } from 'react';
import DatePicker from 'react-datepicker';

export default function CreateChildTaskFrom({
    project,
    task,
    users,
    states,
    types,
    priorities,
    closeModal,
}: {
    project: Project;
    task: Task;
    users: User[];
    states: State[];
    types: Type[];
    priorities: Priority[];
    closeModal: () => void;
}) {
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
        type_id: number | null;
        title: string;
        body: string;
        state_id: number | null;
        manager: string | null;
        priority_id: number | null;
        version_id: number | null;
        start_date: string | null;
        end_date: string | null;
    }>({
        type_id: null,
        title: '',
        body: '',
        state_id: null,
        manager: null,
        priority_id: null,
        version_id: null,
        start_date: '',
        end_date: '',
    });
    console.log(data);

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
        post(route('child_tasks.store', [project.id, task.id]), {
            onSuccess: () => {
                reset();
                setSelectedStartDate(null);
                setSelectedEndDate(null);
                closeModal();
            },
            onError: () => {
                console.log('Error occurred');
            },
            preserveScroll: true,
        });
    };
    return (
        <form className='overflow-y-auto h-lvh-85' onSubmit={handleSubmit}>
            {errors.type_id && <p className='text-red-500'>{errors.type_id}</p>}
            <div className='mb-3'>
                <InputLabel htmlFor='type'>
                    <span className='text-red-500'>*(必須)</span>種別
                </InputLabel>
                <select
                    id='type'
                    className='rounded text-sm min-w-44 max-w-64 border-gray-300 shadow-sm'
                    name='type_id'
                    value={data.type_id ? data.type_id : ''}
                    onChange={(e) => handleSelectType(e, 'type_id')}
                    required
                >
                    <option value='' selected>
                        ----選択してください----
                    </option>
                    {types.map((type) => (
                        <option key={type.id} value={type.id}>
                            {type.type_name}
                        </option>
                    ))}
                </select>
            </div>
            <div className='mb-10'>
                <InputLabel htmlFor='title'>
                    <span className='text-red-500'>*(必須)</span>
                    件名
                </InputLabel>
                <TextInput
                    id='title'
                    className='text-sm w-full'
                    name='title'
                    onChange={(e) => setData('title', e.target.value)}
                    required
                    value={data.title}
                ></TextInput>
            </div>
            <div className='mb-5'>
                <InputLabel value='詳細' htmlFor='body'></InputLabel>
                <textarea
                    className='rounded-md border-gray-300 shadow-sm w-full text-sm'
                    rows={8}
                    name='body'
                    id='body'
                    onChange={(e) => setData('body', e.target.value)}
                    value={data.body}
                ></textarea>
            </div>
            <hr />
            <div className='flex my-5'>
                <div className='w-full flex mr-7'>
                    <label
                        htmlFor='state'
                        className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                    >
                        <span className='text-red-500'>*(必須)</span>
                        状態
                    </label>
                    <select
                        name='state_id'
                        id='state'
                        className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        onChange={(e) => handleSelectType(e, 'state_id')}
                        value={data.state_id ? data.state_id : ''}
                        required
                    >
                        <option value='' selected>
                            ----選択してください----
                        </option>
                        {states.map((state) => (
                            <option key={state.id} value={state.id}>
                                {state.state_name}
                            </option>
                        ))}
                    </select>
                </div>
                <div className='w-full flex'>
                    <label
                        htmlFor='manager'
                        className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                    >
                        <span className='text-red-500'>*(必須)</span>
                        担当者
                    </label>
                    <select
                        name='manager'
                        id='manager'
                        className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        onChange={(e) => setData('manager', e.target.value)}
                        value={data.manager ? data.manager : ''}
                        required
                    >
                        <option value='' selected>
                            ----選択してください----
                        </option>
                        {users.map((user) => (
                            <option key={user.id} value={user.id}>
                                {user.name}
                            </option>
                        ))}
                    </select>
                    {errors.manager && (
                        <p className='text-red-500'>{errors.manager}</p>
                    )}
                </div>
            </div>
            <hr />
            <div className='flex my-5'>
                <div className='w-full flex mr-7'>
                    <label
                        htmlFor='priority'
                        className='font-medium text-sm text-gray-700 w-1/3 flex items-center'
                    >
                        <span className='text-red-500'>*(必須)</span>優先度
                    </label>
                    <select
                        name='priority_id'
                        id='priority'
                        className='rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        onChange={(e) => handleSelectType(e, 'priority_id')}
                        value={data.priority_id ? data.priority_id : ''}
                    >
                        <option value='' selected>
                            未設定
                        </option>
                        {priorities.map((priority) => (
                            <option key={priority.id} value={priority.id}>
                                {priority.priority_name}
                            </option>
                        ))}
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
                        onChange={(e) => handleSelectType(e, 'version_id')}
                        value={data.version_id ? data.version_id : ''}
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
                        onChange={(date) => handleDate('start_date', date)}
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
                        onChange={(date) => handleDate('end_date', date)}
                        locale={ja}
                        placeholderText='日付を選択してください'
                        dateFormat='yyyy/MM/dd'
                        className='p-2 border border-gray-300 rounded-md shadow-sm'
                        isClearable
                    />
                </div>
            </div>
            <div className='flex'>
                <div className='w-full flex mr-7'></div>
                <div className='w-full flex'>
                    <div className='w-1/3'></div>
                    <button
                        disabled={processing}
                        className='bg-green-500 rounded-lg px-4 py-2 border border-gray-300 text-white text-sm font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105'
                    >
                        作成
                    </button>
                </div>
            </div>
        </form>
    );
}
