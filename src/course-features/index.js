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
		const blockProps = useBlockProps( {
			className: 'k1-course-features',
		} );
		const { isLoading, course_features: courseFeatures } = useACF(
			context.postId,
			'course_features'
		);
		return (
			<div { ...blockProps }>
				{ isLoading && <Spinner /> }
				{ ! isSelected && ! isLoading && courseFeatures.length && (
					<>
						<p>
							<strong>Course Features:</strong>
						</p>
						<ul>
							{ courseFeatures.map( ( { feature }, i ) => (
								<li key={ i }>{ feature }</li>
							) ) }
						</ul>
					</>
				) }
				{ isSelected && (
					<PlaceholderBlock
						title="Course Features"
						message="This block displays a list of course features. Features can
					be edited with the Custom Fields panel below the editor."
					/>
				) }
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
