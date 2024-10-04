import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { Spinner } from '@wordpress/components';
import block from './block.json';
import PlaceholderBlock from '../placeholder-block/PlaceholderBlock';
import useACF from '../hooks/useAcf';

registerBlockType( block.name, {
	apiVersion: 3,
	title: block.title,
	icon: block.icon,
	category: block.category,
	attributes: block.attributes,
	edit: ( { isSelected, context } ) => {
		const { postId } = context;
		const { isLoading, course_description: courseDescription } = useACF(
			postId,
			'course_description'
		);
		const blockProps = useBlockProps( {
			className: 'k1-course-description',
		} );
		return (
			<div { ...blockProps }>
				{ ! isSelected && ! isLoading && <p>{ courseDescription }</p> }
				{ isLoading && <Spinner /> }
				{ isSelected && (
					<PlaceholderBlock
						title="Course Description"
						message="This block displays the course description. The description can be edited with the Custom Fields panel below the editor."
					/>
				) }
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
