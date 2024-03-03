const availableTailwindSafeClasses = [
    {
        pattern: /^(-)?(m([lrtb])?|max-w|min-w|max-h|min-h)-(\d+|\d+(\.\d+)?)(.*)$/,
        variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl']
    },
    {
        pattern: /^(bg|text|border|rounded|ring|shadow|divide|placeholder)-((primary|danger|warning|success|info)|[a-z]+-\d{1,3})-?$/,
        variants: ['dark', 'xs', 'sm', 'md', 'lg', 'xl', '2xl']
    },
    {
        // pattern for tailwind rounded size or text size or shadow size
        pattern: /^(rounded|text|shadow|grid-cols|gap)-([a-z]+)-?$/,
        variants: ['xs', 'sm', 'md', 'lg', 'xl', '2xl']
    }
];

export default availableTailwindSafeClasses;