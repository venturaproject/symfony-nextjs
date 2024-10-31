import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';
import Backend from 'i18next-http-backend'; // Importa el backend

i18n
  .use(Backend) // Usa el backend
  .use(initReactI18next)
  .init({
    lng: 'es',
    fallbackLng: 'es',
    interpolation: {
      escapeValue: false,
    },
    backend: {
      loadPath: '/locales/{{lng}}/translation.json',
    },
  })
  .then(() => {
    console.log('i18next initialized:', i18n.isInitialized);
    console.log('Available languages:', i18n.languages);
    console.log('Translation for frontendApp:', i18n.t('frontendApp'));
  })
  .catch((err) => {
    console.error('Error initializing i18next:', err);
  });

export default i18n;
