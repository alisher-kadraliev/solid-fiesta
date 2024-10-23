import path from 'path';
import { fileURLToPath } from 'url';

export default (ctx) => {
    const currentFile = fileURLToPath(import.meta.url);
    const currentDir = path.dirname(currentFile);

    return {
        map: ctx.options.map,
        plugins: {
            'postcss-import': {},
            'tailwindcss/nesting': {},
            tailwindcss: { config: path.join(currentDir, 'tailwind.config.js') },
            autoprefixer: {},
            cssnano: {
                preset: ['default', {
                    discardComments: {
                        removeAll: true,
                    },
                }],
            },
        }
    }
};
