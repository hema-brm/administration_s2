const availableTailwindSafeClasses = [
    {
        pattern: /^(-)?(m([lrtb])?|max-w|min-w|max-h|min-h)-(\d+|\d+(\.\d+)?)(.*)$/
    },
    {
        pattern: /^(bg|text|border|ring|divide|placeholder)-((primary|danger|warning|success|info)|[a-z]+-\d{1,3})-?$/
    },
];

export default availableTailwindSafeClasses;