import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import ProjectLayout from '@/Layouts/ProjectLayout';
import { PageProps, User } from '@/types';
import { Project } from '@/types/project';
import { useEffect, useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { ja } from 'date-fns/locale';
import { useForm } from '@inertiajs/react';
import Message from '@/Components/Message';
import { State } from '@/types/state';
import { Type } from '@/types/type';
import { Priority } from '@/types/priority';
import CreateTaskFrom from '@/features/Task/CreateTaskForm';

export default function TaskCreate({
    project,
    users,
    states,
    types,
    priorities,
    message,
    error_message,
}: PageProps & {
    project: Project;
    users: User[];
    states: State[];
    types: Type[];
    priorities: Priority[];
    message?: string;
    error_message?: string;
}) {
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
            <div className='mx-40 my-8'>
                <CreateTaskFrom
                    project={project}
                    users={users}
                    states={states}
                    types={types}
                    priorities={priorities}
                />
            </div>
        </ProjectLayout>
    );
}
