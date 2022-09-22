const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, CheckboxControl, SelectControl } = wp.components;
const classNames = require( 'classnames' );

function get_search_form_attributes( attributes ) {
	const htmlAttributes = {
		form: {},
		input: {
			name: 'q',
			autocomplete: 'off',
			autofocus: attributes.autofocus || false,
		},
		button: {}
	};

	switch ( attributes.searchengine ) {
		default:
		case 'presearch':
			htmlAttributes.form.action = 'https://presearch.com/search';
			htmlAttributes.input.placeholder = 'Presearch...';
			break
		}

	return htmlAttributes;
}

function get_search_form( htmlAttributes, className ) {
	return (
		<form className={ classNames( className, 'search-form' ) } { ...htmlAttributes.form }>
			<input className="search-field" { ...htmlAttributes.input } />
			<button className="search-submit" { ...htmlAttributes.button }>{ __( 'Search', 'startpage' ) }</button>
		</form>
	);
}

registerBlockType( 'startpage/search-engine-form', {
	title: 'Search Engine Form',
	icon: 'search',
	category: 'layout',
	attributes: {
		searchengine: {
			type: 'string',
		},
		autofocus: {
			type: 'boolean',
			default: false,
		},
	},

	edit( { attributes, setAttributes, className } ) {
		const inspector = (
			<InspectorControls>
				<PanelBody>
					<SelectControl
						label={ __( 'Search Engine', 'startpage' ) }
						onChange={ searchengine => setAttributes( { searchengine } ) }
						value={ attributes.searchengine }
						options={ [
							{
								label: 'Presearch',
								value: 'presearch',
							}
						] }
					/>
					<CheckboxControl
						label={ __( 'Autofocus', 'startpage' ) }
						checked={ attributes.autofocus }
						onChange={ autofocus => setAttributes( { autofocus } ) }
						/>
				</PanelBody>
			</InspectorControls>
		);

		const htmlAttributes = get_search_form_attributes( attributes );
		htmlAttributes.input.autofocus = false;
		htmlAttributes.button.disabled = true;

		return (
			<Fragment>
				{ inspector }
				{ get_search_form( htmlAttributes, className ) }
			</Fragment>
		);
	},

	save( { attributes, className }  ) {
		return get_search_form( get_search_form_attributes( attributes ), className );
	},
} );
