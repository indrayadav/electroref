<tr class="wds-keyword-pair" data-idx="{{- idx }}">
	<td class="wds-pair-keyword">{{- keywords }}</td>
	<td class="wds-pair-url">{{- url }}</td>
	<td class="wds-pair-hidden-fields">
		<input type="hidden" class="wds-pair-keyword-field" value="{{- keywords }}" />
		<input type="hidden" class="wds-pair-url-field" value="{{- url }}"  />
	</td>
	<td class="wds-pair-actions">
		{{ if (idx) { }}
			<?php
				$this->_render( 'links-dropdown', array(
					'label' => esc_html__( 'Options', 'wds' ),
					'links' => array(
						'#edit'   => '<span class="sui-icon-pencil" aria-hidden="true"></span> ' . esc_html__( 'Edit', 'wds' ),
						'#remove' => '<span class="sui-icon-trash" aria-hidden="true"></span> ' . esc_html__( 'Delete', 'wds' ),
					),
				) );
			?>
		{{ } }}
	</td>
</tr>
