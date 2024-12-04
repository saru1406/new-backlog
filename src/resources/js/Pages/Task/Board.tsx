import ProjectLayout from '@/Layouts/ProjectLayout';
import { Project } from '@/types/project';
import { Task } from '@/types/task';
import { useFetchTasks } from '@/hooks/useFetchTaskBoard';
import axios from 'axios';
import { useEffect, useState } from 'react';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';
import { Pagination } from '@/types/pagination';
import BoardCard from '@/Components/BoardCard';

export default function TaskBoard({
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
    const [selectType, setSelectType] = useState<number | null>(null);
    const [selectPriority, setSelectPriority] = useState<number | null>(null);
    const [selectManager, setSelectManager] = useState<number | null>(null);
    const [notStartedTasks, setNotStartedTasks] =
        useState<Pagination<Task> | null>(null);
    const [ongoingTasks, setOngoingTasks] = useState<Pagination<Task> | null>(
        null
    );
    const [compatibleTasks, setCompatibleTasks] =
        useState<Pagination<Task> | null>(null);
    const [completionTasks, setCompletionTasks] =
        useState<Pagination<Task> | null>(null);
    const [selectState, setSelectState] = useState<number | null>(null);
    const [disabledStates, setDisabledStates] = useState({
        notStarted: false,
        ongoing: false,
        compatible: false,
        completion: false,
    });

    const notStartedState = states.find(
        (state) => state.state_name === '未対応'
    );
    const ongoingState = states.find((state) => state.state_name === '処理中');
    const compatibleState = states.find(
        (state) => state.state_name === '処理済み'
    );
    const completionState = states.find((state) => state.state_name === '完了');

    const updateTasks = async () => {
        if (notStartedState) {
            const notStarted = await useFetchTasks(
                project.id,
                notStartedState.id,
                selectType,
                selectPriority,
                selectManager
            );
            setNotStartedTasks(notStarted);
        }
        if (ongoingState) {
            const ongoing = await useFetchTasks(
                project.id,
                ongoingState.id,
                selectType,
                selectPriority,
                selectManager
            );
            setOngoingTasks(ongoing);
        }
        if (compatibleState) {
            const compatible = await useFetchTasks(
                project.id,
                compatibleState.id,
                selectType,
                selectPriority,
                selectManager
            );
            setCompatibleTasks(compatible);
        }
        if (completionState) {
            const completion = await useFetchTasks(
                project.id,
                completionState.id,
                selectType,
                selectPriority,
                selectManager
            );
            setCompletionTasks(completion);
        }
    };

    const updateDisabledStates = () => {
        if (selectState === null) {
            setDisabledStates({
                notStarted: false,
                ongoing: false,
                compatible: false,
                completion: false,
            });
        } else {
            setDisabledStates({
                notStarted: selectState !== notStartedState?.id,
                ongoing: selectState !== ongoingState?.id,
                compatible: selectState !== compatibleState?.id,
                completion: selectState !== completionState?.id,
            });
        }
    };

    useEffect(() => {
        updateTasks();
        updateDisabledStates();
    }, [project.id, selectState, selectType, selectPriority, selectManager]);

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
                <div className='flex'>
                    <label htmlFor='state' className='flex mx-5 items-center'>
                        状態
                    </label>
                    <select
                        className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        name='state_id'
                        id='state'
                        onChange={(e) => {
                            setSelectState(e.target.value === ''
                                ? null
                                : Number(e.target.value));
                        }}
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
                        onChange={(e) =>
                            setSelectType(
                                Number(e.target.value === ''
                                    ? null
                                    : Number(e.target.value))
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
                        className='flex mx-5 items-center'
                    >
                        優先度
                    </label>
                    <select
                        className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
                        name='priority_id'
                        id='priority'
                        onChange={(e) =>
                            setSelectPriority(
                                e.target.value === ''
                                    ? null
                                    : Number(e.target.value)
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
                <div className='mt-8 mb-2'>
                    <div className='flex overflow-x-auto'>
                        <div className='bg-white h-lvh-73 w-full mr-5 border border-gray-200 rounded-md p-2 overflow-y-auto'>
                            <p>未対応</p>
                            <BoardCard
                                tasks={
                                    notStartedTasks
                                        ? notStartedTasks.data
                                        : null
                                }
                                disable={disabledStates.notStarted}
                            ></BoardCard>
                        </div>
                        <div className='bg-white h-lvh-73 w-full mr-5 border border-gray-200 rounded-md p-2 overflow-y-auto'>
                            <p>対応中</p>
                            <BoardCard
                                tasks={ongoingTasks ? ongoingTasks.data : null}
                                disable={disabledStates.ongoing}
                            ></BoardCard>
                        </div>
                        <div className='bg-white h-lvh-73 w-full mr-5 border border-gray-200 rounded-md p-2 overflow-y-auto'>
                            <p>対応済み</p>
                            <BoardCard
                                tasks={
                                    compatibleTasks
                                        ? compatibleTasks.data
                                        : null
                                }
                                disable={disabledStates.compatible}
                            ></BoardCard>
                        </div>
                        <div className='bg-white h-lvh-73 w-full mr-5 border border-gray-200 rounded-md p-2 overflow-y-auto '>
                            <p>完了</p>
                            <BoardCard
                                tasks={
                                    completionTasks
                                        ? completionTasks.data
                                        : null
                                }
                                disable={disabledStates.completion}
                            ></BoardCard>
                        </div>
                    </div>
                </div>
            </div>
        </ProjectLayout>
    );
}
