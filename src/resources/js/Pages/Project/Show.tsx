import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { PageProps } from '@/types';
import { Project } from '@/types/project';
import ProjectsTable from '@/Components/ProjectsTable';
import Modal from '@/Components/Modal';
import { useState, useEffect, FormEventHandler } from 'react';
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import Message from '@/Components/Message';
import Sidebar from '@/Components/Sidebar';
import ProjectLayout from '@/Layouts/ProjectLayout';

export default function ProjectIndex({
    auth,
    project,
    message,
    error_message,
}: PageProps & {
    project: Project;
    message?: string;
    error_message?: string;
}) {
    console.log(project);

    return (
        <ProjectLayout
            project={project}
            header={
                <h2 className='font-semibold text-xl text-gray-800 leading-tight'>
                    {project.project_name}
                </h2>
            }
        ></ProjectLayout>
    );
}
