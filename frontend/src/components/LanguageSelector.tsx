import React, { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import Cookies from 'js-cookie'; // Importa js-cookie
import { MdLanguage } from 'react-icons/md';

const LanguageSelector: React.FC = () => {
    const { i18n } = useTranslation();
    const [dropdownOpen, setDropdownOpen] = useState(false);

    // Función para cambiar el idioma y guardar en la cookie
    const changeLanguage = (lng: string) => {
        i18n.changeLanguage(lng);
        Cookies.set('language', lng, { expires: 365 }); // Guarda la cookie por 1 año
        setDropdownOpen(false); // Cierra el dropdown después de seleccionar un idioma
    };

    // Obtiene el idioma actual de la cookie si existe, o usa el idioma por defecto
    useEffect(() => {
        const savedLanguage = Cookies.get('language');
        if (savedLanguage) {
            i18n.changeLanguage(savedLanguage);
        }
    }, [i18n]);

    const toggleDropdown = () => setDropdownOpen(!dropdownOpen);

    const currentLanguage = i18n.language === 'es' ? 'Español' : 'English';

    return (
        <div className="flex justify-end">
            <div className="relative inline-block text-left">
                <button
                    onClick={toggleDropdown}
                    className="flex items-center px-4 py-2 border rounded-lg bg-transparent hover:bg-transparent focus:outline-none"
                >
                    <MdLanguage className="mr-2" /> {/* Icono de idioma */}
                    {currentLanguage}
                </button>

                {dropdownOpen && (
                    <ul className="absolute right-0 mt-2 py-2 bg-white border rounded-lg shadow-lg min-w-max">
                        <li>
                            <button
                                onClick={() => changeLanguage('es')}
                                className={`block px-4 py-2 text-left ${
                                    i18n.language === 'es' ? 'text-black font-semibold' : 'text-gray-500'
                                }`}
                            >
                                Español
                            </button>
                        </li>
                        <li>
                            <button
                                onClick={() => changeLanguage('en')}
                                className={`block px-4 py-2 text-left ${
                                    i18n.language === 'en' ? 'text-black font-semibold' : 'text-gray-500'
                                }`}
                            >
                                English
                            </button>
                        </li>
                    </ul>
                )}
            </div>
        </div>
    );
};

export default LanguageSelector;
