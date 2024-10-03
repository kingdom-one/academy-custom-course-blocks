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
		const { isLoading, course_price: coursePrice } = useACF(
			context.postId,
			'course_price'
		);

		const blockProps = useBlockProps( {
			className: 'k1-course-price',
		} );
		return (
			<div { ...blockProps }>
				{ isLoading && <Spinner /> }
				{ ! isSelected && ! isLoading && (
					<p>
						<strong>Price: </strong>
						{ coursePrice }
					</p>
				) }
				{ isSelected && (
					<PlaceholderBlock
						title="Course Price"
						message="This block displays the course price, which is mostly used in loops on other pages. The price can be edited with the Custom Fields panel below the editor."
					/>
				) }
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
