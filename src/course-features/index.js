import React, { useState, useEffect } from '@wordpress/element';
import { registerBlockType } from '@wordpress/blocks';
import { Icon, TextControl } from '@wordpress/components';
import { useBlockProps } from '@wordpress/block-editor';
import block from './block.json';

registerBlockType( block.name, {
	apiVersion: 3,
	title: block.title,
	icon: block.icon,
	category: block.category,
	attributes: block.attributes,
	edit: ( { attributes, setAttributes, isSelected } ) => {
		const { features } = attributes;
		const [ courseFeatures, setCourseFeatures ] = useState(
			features || [ '60 minute course', '10 lessons', '5 quizzes' ]
		);

		useEffect( () => {
			setAttributes( { features: courseFeatures } );
		}, [ courseFeatures ] );

		const blockProps = useBlockProps( {
			className: 'k1-course-features',
		} );
		return (
			<div { ...blockProps }>
				<p>
					<strong>Course Features:</strong>
				</p>
				<ul>
					{ courseFeatures.map( ( feature, index ) => (
						<li
							style={ {
								display: 'grid',
								gridTemplateColumns: '95% 5%',
								alignItems: 'stretch',
								alignContent: 'stretch',
							} }
							key={ index }
						>
							<TextControl
								value={ feature }
								onChange={ ( newValue ) => {
									const updatedFeatures = [
										...courseFeatures,
									];
									updatedFeatures[ index ] = newValue;
									setCourseFeatures( updatedFeatures );
								} }
							/>
							<button
								onClick={ ( ev ) => {
									ev.preventDefault();
									const updatedFeatures =
										courseFeatures.filter(
											( _, i ) => i !== index
										);
									setCourseFeatures( updatedFeatures );
								} }
							>
								<Icon icon="minus" />
							</button>
						</li>
					) ) }
					{ isSelected && (
						<li>
							<button
								onClick={ ( ev ) => {
									ev.preventDefault();
									setCourseFeatures( ( prev ) => [
										...prev,
										'',
									] );
								} }
							>
								Add New <Icon icon="plus" />
							</button>
						</li>
					) }
				</ul>
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
