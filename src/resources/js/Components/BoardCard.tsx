import { Task } from '@/types/task';
import { format } from 'date-fns';

export default function BoardCard({
    tasks,
    disable = false,
}: {
    tasks: Task[] | null;
    disable?: boolean;
}) {
    if (disable) {
        return <div></div>;
    }
    return (
        <div>
            {tasks ? (
                tasks.map((task) => (
                    <div
                        key={task.id}
                        className='card text-left text-xs border border-gray-300 m-2 rounded-md shadow-md py-4 px-5 bg-white hover:shadow-lg transition-shadow duration-200 ease-in-out'
                    >
                        <div className='card-body'>
                            <h4 className='card-title text-gray-800 mb-3 text-sm'>
                                {task.title}
                            </h4>
                            <p>
                                開始日:{' '}
                                {format(
                                    new Date(task.start_date),
                                    'yyyy/MM/dd'
                                )}
                            </p>
                            <p>
                                期限日:{' '}
                                {format(new Date(task.end_date), 'yyyy/MM/dd')}
                            </p>
                            <div className='card-footer text-right text-gray-700 border-t pt-2 mt-3'>
                                担当者:{' '}
                                <span className='text-gray-800'>
                                    {task.manager.name}
                                </span>
                            </div>
                        </div>
                    </div>
                ))
            ) : (
                <div className='text-center text-gray-500 py-4'>
                    タスクがありません
                </div>
            )}
        </div>
    );
}
