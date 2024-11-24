import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

export default function FormModal({
    openModal,
    closeModal,
    fields,
    setData,
    processing,
    handleSubmit,
    title = 'フォーム',
    submitText = '送信',
}: {
    openModal: boolean;
    closeModal: () => void;
    fields: [
        {
            name: string;
            label: string;
            value: string;
            error?: string;
        },
    ];
    setData: (field: string, value: string) => void;
    processing: boolean;
    handleSubmit: (e: React.FormEvent) => void;
    title?: string;
    submitText?: string;
}) {
    return (
        <Modal show={openModal} onClose={closeModal} maxWidth='xl'>
            <form
                onSubmit={handleSubmit}
                className='w-full max-w-xl my-24 mx-10'
            >
                {title && <h2 className='text-lg font-bold mb-4'>{title}</h2>}
                <div>
                    {fields.map((field) => (
                        <div key={field.name} className='mb-5'>
                            <InputLabel value={field.label} />
                            {field.error && (
                                <p className='text-red-500'>{field.error}</p>
                            )}
                            <TextInput
                                className='w-5/6'
                                value={field.value}
                                onChange={(e) =>
                                    setData(field.name, e.target.value)
                                }
                            />
                        </div>
                    ))}
                    <div className='my-5'>
                        <PrimaryButton
                            className='bg-blue-500'
                            disabled={processing}
                        >
                            {processing ? '処理中...' : submitText}
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </Modal>
    );
}
