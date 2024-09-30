import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import block from './block.json';

registerBlockType( block.name, {
	apiVersion: 3,
	title: block.title,
	icon: block.icon,
	category: block.category,
	attributes: block.attributes,
	edit: ( { attributes, setAttributes } ) => {
		const { features } = attributes;
		console.log( features );
		const blockProps = useBlockProps( {
			className: 'k1-course-features',
		} );
		return (
			<div { ...blockProps }>
				<p>
					<strong>Course Features:</strong>
				</p>
				<ul>
					<RichText
						tagName="li"
						value={ features }
						onChange={ ( features ) => {
							setAttributes( { features } );
						} }
						placeholder="Enter course features..."
					/>
				</ul>
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
