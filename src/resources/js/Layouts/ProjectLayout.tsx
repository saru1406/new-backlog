import Sidebar from '@/Components/Sidebar';
import { Project } from '@/types/project';
import { PropsWithChildren, ReactNode } from 'react';

export default function ProjectLayout({
    project,
    header,
    children,
}: PropsWithChildren<{ project: Project; header?: ReactNode }>) {
    return (
        <div className='flex flex-col h-screen'>
            <div className='flex flex-1'>
                <Sidebar project={project}></Sidebar>
                <div className='flex-1 flex flex-col bg-gray-100'>
                    {header && (
                        <header className='bg-white shadow'>
                            <div className='max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8'>
                                {header}
                            </div>
                        </header>
                    )}
                    <div className='container mx-auto mb-4 flex-1 overflow-y-auto'>
                        {children}
                    </div>
                </div>
            </div>
        </div>
    );
}
