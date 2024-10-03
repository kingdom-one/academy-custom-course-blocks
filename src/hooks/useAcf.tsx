import { useEntityRecord } from '@wordpress/core-data';

export default function useACF( postId: number, acfField: string ) {
	const { record, isResolving: isLoading } = useEntityRecord(
		'postType',
		'course',
		postId
	);
	const field = record?.acf[ acfField ];
	return {
		isLoading,
		[ acfField ]: field || null,
	};
}
