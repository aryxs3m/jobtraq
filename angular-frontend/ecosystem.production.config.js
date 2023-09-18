module.exports = {
  apps: [
    {
      name: 'jobtraq-fe-production',
      script: './dist/angular-frontend/server/main.js',
      instances: 'max',
      exec_mode: 'cluster',
      env: {
        PORT: 4001,
      },
    },
  ],
};
