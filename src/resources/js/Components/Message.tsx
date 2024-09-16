import { useState, useEffect } from 'react';

export default function Message({
    message,
    error_message,
}: {
    message?: string;
    error_message?: string;
}) {
    const [displayMessage, setDisplayMessage] = useState<string | undefined>(
        message
    );
    const [displayErrorMessage, setDisplayErrorMessage] = useState<
        string | undefined
    >(error_message);

    console.log(displayMessage);

    // エラーメッセージを10秒表示後、削除
    useEffect(() => {
        if (message) {
            setDisplayMessage(message);
        }
        if (error_message) {
            setDisplayErrorMessage(error_message);
        }

        const timer = setTimeout(() => {
            setDisplayMessage(undefined);
            setDisplayErrorMessage(undefined);
        }, 5000); // 5秒後にメッセージをクリア

        // クリーンアップ関数でタイマーをクリア
        return () => clearTimeout(timer);
    }, [message, error_message]);

    return (
        <>
            {displayMessage && (
                <div
                    className='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4'
                    role='alert'
                >
                    <span className='block sm:inline'>{displayMessage}</span>
                </div>
            )}
            {displayErrorMessage && (
                <div
                    className='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4'
                    role='alert'
                >
                    <span className='block sm:inline'>
                        {displayErrorMessage}
                    </span>
                </div>
            )}
        </>
    );
}
