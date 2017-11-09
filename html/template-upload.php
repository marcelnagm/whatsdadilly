script id="template-upload" type="text/x-tmpl">
                                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                    <tr class="template-upload fade">
                                                        <td>
                                                            <span class="preview"></span>
                                                        </td>
                                                        <td>
                                                            <p class="name">{%=file.name%}</p>
                                                            <p class="size">Processing...</p>
                                                            <strong class="error"></strong>
                                                        </td>
                                                        <td>
                                                            
                                                            <div class="progress"></div>
                                                        </td>
                                                        <td>
                                                            {% if (!i && !o.options.autoUpload) { %}
                                                            <button class="start">Start</button>
                                                            {% } %}
                                                            {% if (!i) { %}
                                                            <button class="cancel">Cancel</button>
                                                            {% } %}
                                                        </td>
                                                    </tr>
                                                    {% } %}
                                                </script>