import ProjectLayout from '@/Layouts/ProjectLayout';
import { Priority } from '@/types/priority';
import { Project } from '@/types/project';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { useForm } from '@inertiajs/react';
import { useState } from 'react';
import DatePicker from 'react-datepicker';
import { ja } from 'date-fns/locale';
import 'react-datepicker/dist/react-datepicker.css';

export default function Gantt({
    project,
    states,
    types,
    priorities,
}: {
    project: Project;
    states: State[];
    types: Type[];
    priorities: Priority[];
}) {
    const [selectedStartDate, setSelectedStartDate] = useState<Date | null>(
        null
    );
    const [selectType, setSelectType] = useState<number | null>(null);
    const [selectPriority, setSelectPriority] = useState<number | null>(null);
    const [selectState, setSelectState] = useState<number | null>(null);
    const [selectGroup, setSelectGroup] = useState<string | null>(null);
    const [selectScale, setSelectScale] = useState<string | null>(null);
    const [selectPeriod, setSelectPeriod] = useState<string | null>(null);

    const handleDate = (name: 'start_date', date: null | Date): void => {
        if (name === 'start_date') {
            setSelectedStartDate(date);
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

    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        >
            <div className='mt-8 mb-2 mx-5 text-sm'>
                <div>
                    <div className='m-5'>
                        <h3>絞り込み項目</h3>
                    </div>
                    <div className='flex mb-4'>
                        <label
                            htmlFor='state'
                            className='flex mx-5 items-center text-nowrap'
                        >
                            状態
                        </label>
                        <select
                            className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                            name='state_id'
                            id='state'
                            onChange={(e) => {
                                const selectedValue =
                                    e.target.value === ''
                                        ? null
                                        : Number(e.target.value);
                                setSelectState(selectedValue);
                            }}
                        >
                            <option value=''>未選択</option>
                            {states.map((state) => (
                                <option key={state.id} value={state.id}>
                                    {state.state_name}
                                </option>
                            ))}
                        </select>
                        <label
                            htmlFor='type'
                            className='flex mx-5 items-center text-nowrap'
                        >
                            種別
                        </label>
                        <select
                            className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                            name='type_id'
                            id='type'
                            onChange={(e) =>
                                setSelectType(
                                    Number(
                                        (e.target as HTMLSelectElement).value
                                    )
                                )
                            }
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
                            className='flex mx-5 items-center text-nowrap'
                        >
                            優先度
                        </label>
                        <select
                            className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                            name='priority_id'
                            id='priority'
                            onChange={(e) =>
                                setSelectPriority(
                                    Number(
                                        (e.target as HTMLSelectElement).value
                                    )
                                )
                            }
                        >
                            <option value=''>未選択</option>
                            {priorities.map((priority) => (
                                <option key={priority.id} value={priority.id}>
                                    {priority.priority_name}
                                </option>
                            ))}
                        </select>
                        {/* <select
                    className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                    name='manager_id'
                    id='manager'
                    onClick={(e) => setPriority(Number((e.target as HTMLSelectElement).value))}
                >
                    <option value=''>選択</option>
                    {managers.map((manager) => (
                        <option key={manager.id} value={manager.id}>
                            {manager.name}
                        </option>
                    ))}
                </select> */}
                    </div>
                    <hr />
                </div>
                <div className='flex'>
                    <div>
                        <div className='m-5'>
                            <h3>グルーピング</h3>
                        </div>
                        <div className='flex mb-4 mr-5'>
                            <div className='flex'>
                                <label
                                    htmlFor='scale'
                                    className='flex mx-5 items-center text-nowrap'
                                >
                                    スケール
                                </label>
                                <select
                                    className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                    name='scale'
                                    id='scale'
                                    onChange={(e) => {
                                        setSelectScale(
                                            e.target.value === ''
                                                ? null
                                                : e.target.value
                                        );
                                    }}
                                >
                                    <option value='日'>日</option>
                                    <option value='週'>週</option>
                                    <option value='月'>月</option>
                                </select>
                            </div>
                            <div className='flex'>
                                <label
                                    htmlFor='group'
                                    className='flex mx-5 items-center text-nowrap'
                                >
                                    グループ
                                </label>
                                <select
                                    className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                    name='group'
                                    id='group'
                                    onChange={(e) => {
                                        setSelectGroup(
                                            e.target.value === ''
                                                ? null
                                                : e.target.value
                                        );
                                    }}
                                >
                                    <option value=''>未選択</option>
                                    <option value='担当者'>担当者</option>
                                    <option value='種別'>種別</option>
                                    <option value='優先度'>優先度</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div className='border-l border-gray-200 my-5'></div>
                    <div>
                        <div className='m-5'>
                            <h3>表示期間</h3>
                        </div>
                        <div className='flex'>
                            <div className='flex mb-4'>
                                <label
                                    htmlFor='start_date'
                                    className='flex mx-5 items-center text-nowrap'
                                >
                                    開始日
                                </label>
                                <div className=''>
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
                            </div>
                            <div className='flex mb-4'>
                                <label
                                    htmlFor='period'
                                    className='flex mx-5 items-center text-nowrap'
                                >
                                    期間
                                </label>
                                <select
                                    className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                                    name='period'
                                    id='period'
                                    onChange={(e) => {
                                        setSelectPeriod(
                                            e.target.value === ''
                                                ? null
                                                : e.target.value
                                        );
                                    }}
                                >
                                    <option value='1ヶ月'>1ヶ月</option>
                                    <option value='2ヶ月'>2ヶ月</option>
                                    <option value='3ヶ月'>3ヶ月</option>
                                    {/* <option value='4ヶ月'>4ヶ月</option> */}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
        </ProjectLayout>
    );
}
