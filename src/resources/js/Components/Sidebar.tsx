import ProjectIndex from '@/Pages/Project/Index';
import { Project } from '@/types/project';
import { Link } from '@inertiajs/react';

export default function Sidebar({ project }: { project: Project }) {
    return (
        <div className='max-w-56 min-w-52 bg-gray-800 text-white pt-14 sticky top-0 h-screen'>
            <div className='flex flex-col h-full justify-end'>
                <div>
                    <Link
                        href={route('projects.index')}
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        プロジェクト一覧
                    </Link>
                    <Link
                        href={route('projects.show', project.id)}
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        ダッシュボード
                    </Link>
                    <Link
                        href='#'
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        課題追加
                    </Link>
                    <Link
                        href='#'
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        課題一覧
                    </Link>
                    <Link
                        href='#'
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        ボード
                    </Link>
                    <Link
                        href='#'
                        className='hover:text-gray-300 hover:bg-blue-900 block p-5'
                    >
                        ガントチャート
                    </Link>
                </div>
                <div className='flex-1 flex flex-col justify-end mb-5'>
                    <Link
                        href={route('logout')}
                        method='post'
                        className='hover:bg-gray-600 block p-5 text-left'
                        as='button'
                    >
                        ログアウト
                    </Link>
                </div>
            </div>
        </div>
    );
}
