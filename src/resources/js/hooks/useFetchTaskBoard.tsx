import { fetchApi } from '@/services/taskService';
import { Task } from '@/types/task';
import { Pagination } from '@/types/pagination';

export const useFetchTasks = async (
    projectId: string,
    stateId: number,
    typeId: number | null = null,
    priorityId: number | null = null,
    managerId: number | null = null
): Promise<Pagination<Task> | null> => {
    const base = `/api/v1/projects/${projectId}/tasks/fetch-board`;
    const params = new URLSearchParams({
        state_id: stateId.toString(),
    });

    if (typeId !== null) params.append('type_id', typeId.toString());
    if (priorityId !== null)
        params.append('priority_id', priorityId.toString());
    if (managerId !== null) params.append('manager_id', managerId.toString());
    const url = `${base}?${params.toString()}`;

    const response = await fetchApi(url);
    return response.data;
};
