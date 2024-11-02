import { useState, useEffect } from 'react';
import { fetchApi } from "@/services/taskService";
import { Task } from "@/types/task";
import { Pagination } from "@/types/pagination";

export const useFetchTasks = (projectId: string) => {
    const [tasks, setTasks] = useState<Pagination<Task> | null>(null);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<Error | null>(null);
    const url = `/api/v1/projects/${projectId}/tasks/fetch-board`;

    useEffect(() => {
        const loadTasks = async () => {
            setLoading(true);
            try {
                const response = await fetchApi(url)
                setTasks(response.data);
            } catch (err) {
                setError(err as Error);
            } finally {
                setLoading(false);
            }
        };

        if (projectId) {
            loadTasks();
        }
    }, [projectId]);

    return { tasks, loading, error };
};
