type OptionType = { id: number; [key: string]: any };

export default function Select({
    options,
    column,
}: {
    options: OptionType[];
    column: string;
}) {
    return (
        <select
            className='flex rounded-md border-gray-300 shadow-sm min-w-48 max-w-60 text-sm'
            name='state_id'
            id='state'
        >
            <option value=''>選択</option>
            {options.map((option) => (
                <option key={option.id} value={option.id}>
                    {option[column]}
                </option>
            ))}
        </select>
    );
}
